import { Router, Request, Response } from 'express';
import { getGoogleAuthURL, getGoogleUser } from '../helpers/googleAuth.js';

const router = Router();

router.get('/google', (_: Request, res: Response) => {
    res.redirect(getGoogleAuthURL());
});

router.get('/google/callback', async (req: Request, res: Response) => {
    const code: string = req.query.code;
    const user = await getGoogleUser({ code: code });
    const json = await user.json();
    return res.status(200).json(json);
});

export default router;