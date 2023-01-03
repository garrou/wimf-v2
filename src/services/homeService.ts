import { Request, Response } from 'express';

const renderHome = (_: Request, res: Response) => {
    res.render('index');
}

export default renderHome;