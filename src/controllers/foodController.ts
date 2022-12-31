import { Router, Request, Response } from 'express';
import { checkJwt } from '../helpers/jwt.js';

const router = Router();

router.get('/', checkJwt, (req: Request, res: Response) => {
    return res.status(200).json(req.user);
});

export default router;