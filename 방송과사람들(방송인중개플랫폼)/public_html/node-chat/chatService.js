const { pool } = require('./db'); // db.js에서 pool 가져오기

//메시지 저장
async function setMessage(user, message){
    const insertDate = new Date(); // 현재 날짜와 시간 가져오기
    const query = "insert into member_chat set room_idx = ? , sender_idx = ? , message = ? , insert_date = ? , confirm = ?";
    let messageId = '';
    try {
        const [result] = await pool.execute(query, [user.room, message.mbNo,message.text, insertDate, '1']);
        messageId = result.insertId;
    }catch (e) {
        console.error('Error storing message in database:', error);
        throw error; // 에러를 다시 던져 상위에서 처리 가능
    }
    return messageId;
}

async function setMessageRead(room, mbNo){
    const updateQuery = "UPDATE member_chat SET confirm = NULL WHERE room_idx = ? and sender_idx != ?";

    try {
        const [result] = await pool.execute(updateQuery, [room, mbNo]);
        return result.insertId;
    }catch (e) {
        console.error('Error message in database:', e);
        throw e;
    }
}

module.exports = {
    setMessage,
    setMessageRead,
};