import { Request, Response } from 'express';

const renderCategories = async (req: Request, res: Response) => {
    res.render('account/categories', {
        user: req.user
    });
}

export { renderCategories };