import jwt from 'jsonwebtoken';
import { Request, Response } from 'express';

const createJwt = (id: number, email: string) => jwt.sign(
    {
        id: id,
        email: email
    }, process.env.SECRET_TOKEN
);

const checkJwt = (req: Request, res: Response, next: Function) => {
    const authHeader = req.headers.authorization;
    const token = authHeader && authHeader.split(' ')[1];
    
    jwt.verify(token, process.env.SECRET_TOKEN, (err: Error, user: any) => {
        if (err) {
            return res.sendStatus(403);
        }
        req.user = user;
        next();
    });    
};

export { createJwt, checkJwt };