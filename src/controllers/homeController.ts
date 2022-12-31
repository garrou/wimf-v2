import { Router, Request, Response } from 'express';
import isLoggedIn from '../helpers/guard.js';

const router = Router();

router.get('/protected', isLoggedIn, (req: Request, res: Response) => {
    return res.status(200).json(req.user);
});

export default router;