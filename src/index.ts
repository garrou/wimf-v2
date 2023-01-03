import express from 'express';
import cookieParser from 'cookie-parser';
import authController from './controllers/authController.js';
import foodController from './controllers/categoryController.js';
import homeController from './controllers/homeController.js';

const app = express();

app.use(cookieParser());
app.set('view engine', 'ejs');
app.set('views', './src/views');

app.use('/', homeController);
app.use('/auth', authController);
app.use('/categories', foodController);

app.listen(process.env.SERVER_PORT, process.env.SERVER_ADDRESS);