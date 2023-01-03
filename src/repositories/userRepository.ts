import User from '../models/user.js';
import pool from './config.js';

const insertUser = async (user: User): Promise<void> => {
    try {
        const client = await pool.connect();
        await client.query(`
            INSERT INTO members (id, email, picture, provider)
            VALUES ($1, $2, $3, $4)
        `, [user.id, user.email, user.picture, user.provider]);
        
        client.release();
    } catch (err) {
        throw err;
    }
};

const countUserByEmail = async (email: string): Promise<any> => {
    try {
        const client = await pool.connect();
        const res = await client.query(`
            SELECT COUNT(*)
            FROM members
            WHERE email = $1
        `, [email]);

        client.release();

        return res.rowCount;
    } catch (err) {
        throw err;
    }
};

export { insertUser, countUserByEmail };