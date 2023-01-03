import dotenv from 'dotenv';
import fetch from 'node-fetch';
import { OAuth2Client } from 'google-auth-library';
import { Request, Response } from 'express';

dotenv.config();

const oauth2Client = new OAuth2Client(
    process.env.GOOGLE_ID,
    process.env.GOOGLE_SECRET,
    process.env.GOOGLE_CALLBACK
);

const generateGoogleAuthUrl = (): string => {
    const scopes = [
        'https://www.googleapis.com/auth/userinfo.profile',
        'https://www.googleapis.com/auth/userinfo.email',
    ];

    return oauth2Client.generateAuthUrl({
        access_type: 'offline',
        prompt: 'consent',
        scope: scopes,
    });
};

const getUser = async (accessToken: string): Promise<any> => {
    try {
        return await fetch(
            `https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=${accessToken}`,
            {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            },
        );
    } catch (err) {
        throw err;
    }
}

const getGoogleUser = async (code: string): Promise<any> => {
    const { tokens } = await oauth2Client.getToken(code);

    oauth2Client.setCredentials(tokens);

    try {
        return await getUser(tokens.id_token);
    } catch (err) {
        throw err;
    }
};

const verify = async (token: string): Promise<any> => {
    const ticket = await oauth2Client.verifyIdToken({
        idToken: token,
        audience: process.env.GOOGLE_ID,
    });
    const payload = ticket.getPayload();
    return {
        id: payload.sub,
        email: payload.email,
        name: payload.name,
        picture: payload.picture
    };
};


const checkJwt = async (req: Request, res: Response, next: Function): Promise<void> => {
    let token = req.cookies.accessToken;

    try {
        req.user = await verify(token);
        next();
    } catch (err) {
        res.redirect('/auth');
    }
}

export { oauth2Client, generateGoogleAuthUrl, getGoogleUser, checkJwt };