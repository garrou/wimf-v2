import dotenv from 'dotenv';
import fetch from 'node-fetch';
import { google } from 'googleapis';

dotenv.config();

const oauth2Client = new google.auth.OAuth2(
    process.env.GOOGLE_ID,
    process.env.GOOGLE_SECRET,
    'http://localhost:8080/api/auth/google/callback'
);

const getGoogleAuthURL = (): string => {
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

const getGoogleUser = async ({ code }) => {
    const { tokens } = await oauth2Client.getToken(code);

    try {
        return await fetch(
            `https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=${tokens.access_token}`,
            {
                headers: {
                    Authorization: `Bearer ${tokens.id_token}`,
                },
            },
        );
    } catch (err) {
        throw new Error(err.message);
    }
};

const googleAuth = async (input) => {
    const googleUser = await getGoogleUser({ code: input.code });

    // in database
    console.log(googleUser);
};

export { getGoogleAuthURL, getGoogleUser, googleAuth };