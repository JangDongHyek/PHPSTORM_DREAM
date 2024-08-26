const express = require("express");
const schedule = require("node-schedule");
const session = require("express-session");
const dotenv = require("dotenv");
const cookieParser = require("cookie-parser");
const webSocket = require("./socket.js");
const path = require("path");
const cors = require("cors");
const fs = require("fs");
const https = require('https');
const credentials = {
    ca: fs.readFileSync('/etc/httpd/conf/ssl.crt/AAA_CERTIFICATE_SERVICES.crt'),
    key: fs.readFileSync('/etc/httpd/conf/ssl.key/www.jobgo.ac.key'),
    cert: fs.readFileSync('/etc/httpd/conf/ssl.crt/www.jobgo.ac.crt'),
};

dotenv.config();

const SpotifyWebApi = require('spotify-web-api-node');

//스포티파이 로그인하기
const spotifyApi = new SpotifyWebApi({
    clientId: 'f5bb2ace62de4f71be95f953e7447717',
    clientSecret: 'c6723f6dccc1494cb3f90cd109e56eb1',
    redirectUri: 'https://jobgo.ac:3001/callback'
});

// Spotify API 사용을 위한 상태와 권한 스코프 설정
const state = 'some-state-of-my-choice';
const scopes = ['user-read-private','user-read-email'];

// Spotify 인증 URL 생성
const authorizeURL = spotifyApi.createAuthorizeURL(scopes, state);

console.log('authorizeURL: ' , authorizeURL);

const app = express();
app.set("port", process.env.PORT || 3001);
app.set("view engine", "html");
app.use(
  cors({
    origin: "*",
    credentials: true,
  })
);
app.use(cookieParser(process.env.COOKIE_SECRET)); //쿠키를 암호화해서 파싱하기

app.use(express.static(path.join(__dirname, "public"))); // /public을 url주소 /로 해도 바로 접근이 가능하게
app.use("/uploads", express.static(path.join(__dirname, "uploads"))); //파일첨부 디렉토리 설정
app.use(express.json()); //json을 사용한다
app.use(express.urlencoded({ extended: true })); //url 인코드를 사용하지 않겠다.

const router = express.Router();

// 토큰 새로고침
async function refreshAccessToken() {
    try {
        const data = await spotifyApi.refreshAccessToken();
        console.log('The access token has been refreshed!');
        spotifyApi.setAccessToken(data.body['access_token']);
        return data.body['access_token'];
    } catch (err) {
        console.error('Could not refresh access token', err);
        throw err;
    }
}

// 미들웨어 추가
router.use(async (req, res, next) => {
    try {
        if (!spotifyApi.getAccessToken()) {
            // If no token is set, try to refresh it
            await refreshAccessToken();
        }
        next();
    } catch (error) {
        res.status(401).json({ error: 'Unauthorized: Unable to refresh token' });
    }
});

// music.getSearchSuggestions("Lilac").then(res => {
//     console.log(res)
// });

//음원검색하기 -- PHP API 로 대체
router.get("/song_search",async (req,res,next) => {
    try {
        const data = await spotifyApi.searchTracks(req.query.music, {
            offset: req.query.offset,
            limit: 20,
            fields: 'items'
        });
        res.json(data.body);
    } catch (err) {
        console.log('음원검색 에러 /song_search');
        console.error(err);
        if (err.statusCode === 401) {
            // Token might be expired, try to refresh
            try {
                await refreshAccessToken();
                // Retry the search after refreshing the token
                const data = await spotifyApi.searchTracks(req.query.music, {
                    offset: req.query.offset,
                    limit: 20,
                    fields: 'items'
                });
                res.json(data.body);
            } catch (refreshErr) {
                res.status(401).json({ error: 'Unauthorized: Unable to refresh token' });
            }
        } else {
            res.status(500).json({ error: "Error occurred while searching tracks" });
        }
    }
});

//토큰 발급하기
router.get("/callback",(req,res,next) =>{
    spotifyApi.authorizationCodeGrant(req.query.code).then(
        function(data) {
            console.log('The token expires in ' + data.body['expires_in']);
            console.log('The access token is ' + data.body['access_token']);
            console.log('The refresh token is ' + data.body['refresh_token']);

            spotifyApi.setAccessToken(data.body['access_token']);
            spotifyApi.setRefreshToken(data.body['refresh_token']);

            res.redirect('/'); // Redirect to your frontend after successful authentication
        },
        function(err) {
            console.log('Something went wrong!', err);
            res.status(500).send('Authentication failed');
        }
    );
});

router.get("/reToken",(req,res,next)=>{
	const authorizeURL = spotifyApi.createAuthorizeURL(scopes, state);
	return res.json({url:authorizeURL});
});

//50분마다 토큰값 갱신하기
schedule.scheduleJob('0 0/50 * * * *', async () => {
    try {
        await refreshAccessToken();
        console.log("Access token refreshed by scheduler");
    } catch (error) {
        console.error("Scheduled token refresh failed:", error);
    }
  console.log("스케줄러");
});
app.use(router);

app.use((req, res, next) => {
    console.log("모든 요청에 다 실행됩니다.");
    const error = new Error(`${req.method} ${req.url} 라우터가 없습니다.`);
    error.status = 404;
    next(); //다음 미들웨어에 검수하기
});

//최종적으로 오류가 발생하면 메세지 보여주기
app.use((err, req, res, next) => {
    console.log('에러:');
    console.error(err);
    res.status(err.status || 500).send(err.message);
});
const server=https.createServer(credentials,app).listen(3001,()=>{
	console.log(3001, "번 포트에서 대기중");
});

webSocket(server, app);