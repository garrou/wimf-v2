import { Request, Response } from 'express';
import { generateGoogleAuthUrl, getGoogleUser, oauth2Client } from '../helpers/googleAuth.js';
import User from '../models/user.js';
import { countUserByEmail, insertUser } from '../repositories/userRepository.js';

const renderAuth = (_: Request, res: Response) => {
    res.render('auth');
}

const getGoogleAuthUrl = (_: Request, res: Response) => {
    res.redirect(generateGoogleAuthUrl());
}

const googleCallback = async (req: Request, res: Response) => {
    const code: string = req.query.code;
    const resp: any = await getGoogleUser(code);
    const json: any = await resp.json();
    const nb: number = await countUserByEmail(json.email);

    if (nb === 0) {
        await insertUser(new User(
            json.id,
            json.email,
            json.picture,
            'google'
        ));
    } 
    
    res.cookie('accessToken', oauth2Client.credentials.access_token);
    res.cookie('accessToken', oauth2Client.credentials.refresh_token);
    res.redirect('/categories');
}

export { renderAuth, getGoogleAuthUrl, googleCallback };