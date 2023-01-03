import express from 'express';
import cookieParser from 'cookie-parser';
import authController from './controllers/authController.js';
import foodController from './controllers/categoryController.js';
import homeController from './controllers/homeController.js';

const address: string = process.env.SERVER_ADDRESS;
const port: string = process.env.SERVER_PORT;
const app: express.Application = express();

app.use(cookieParser());
app.set('view engine', 'ejs');
app.set('views', './src/views');

app.use('/', homeController);
app.use('/auth', authController);
app.use('/categories', foodController);

app.listen(port, address, () => {
    console.log(`Server running : http://${address}:${port}`);
});