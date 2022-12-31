import { Router, Request, Response } from 'express';
import passport from '../helpers/auth.js';

const router = Router();

router.get('/google', passport.authenticate('google', 
    { 
        scope: ['email', 'profile'] 
    }
));

router.get('/google/callback', passport.authenticate(
    'google', {
        successRedirect: '/api/protected',
        failureRedirect: '/'
    }
));

router.get('/logout', (req: Request, res: Response) => {
    req.logout();
    return res.status(200).json({'message': 'Déconnexion'});
});

export default router;