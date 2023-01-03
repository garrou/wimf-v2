import { Router } from 'express';
import { checkJwt } from '../helpers/googleAuth.js';
import { renderCategories } from '../services/categoryService.js';

const router = Router();

router.get('/', checkJwt, renderCategories);

export default router;