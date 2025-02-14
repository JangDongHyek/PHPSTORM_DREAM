const moment = require("moment");

moment.locale('ko');

let generateMessage = (from, text)=>{
    return {
        from,
        text,
        createdAt: moment().valueOf()
    };
};

module.exports = {generateMessage};