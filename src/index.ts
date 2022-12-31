import dotenv from 'dotenv';
import express from 'express';
import session from 'express-session';
import authController from './controllers/authController.js';
import homeController from './controllers/homeController.js';
import passport from './helpers/auth.js';

dotenv.config();

const app = express();

app.use(session({ 
    secret: 'cats', 
    resave: false,
    saveUninitialized: true 
}));
app.use(passport.initialize());
app.use(passport.session());

app.use('/api/auth', authController);
app.use('/api', homeController);

const server = app.listen(8080, '127.0.0.1', () => {
    const host = server.address().address;
    const port = server.address().port;

    console.log('Application running at http://%s:%s', host, port);
});