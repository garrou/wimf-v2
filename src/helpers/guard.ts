import { Request, Response } from 'express';

const isLoggedIn = (req: Request, res: Response, next) => {
    return req.user ? next() : res.status(401).json({'message': 'Unauthorized'});
};

export default isLoggedIn;