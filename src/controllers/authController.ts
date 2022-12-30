import { Router, Request, Response } from 'express';
import passport from '../helpers/auth.js';

const router = Router();

router.get('/google', passport.authenticate('google', 
    { 
        scope: [ 'email', 'profile' ] 
    }
));

router.get('/google/callback', passport.authenticate(
    'google', {
        successRedirect: '/protected',
        failureRedirect: '/failure'
    }
), (req: Request, res: Response) => {

});

export default router;