const mysql = require('mysql2/promise');

const pool = mysql.createPool({
    host: 'localhost',
    user: 'broadcast',
    password: 'c3gq%qyc',
    database: 'broadcast',
    waitForConnections: true,
    connectionLimit: 1000,
    queueLimit: 0
});

async function connectDB() {
    try {
        await pool.getConnection(); // Test the connection
        console.log('Database connected successfully!');
    } catch (err) {
        console.error('Error connecting to the database:', err);
    }
}

connectDB();

module.exports = { pool };