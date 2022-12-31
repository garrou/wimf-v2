import express from 'express';
import authController from './controllers/authController.js';
import foodController from './controllers/foodController.js';

const app = express();

app.use('/api/auth', authController);
app.use('/api/foods', foodController);

const server = app.listen(8080, '127.0.0.1', () => {
    const host = server.address().address;
    const port = server.address().port;

    console.log('Application running at http://%s:%s', host, port);
});