import { Router } from 'express';
import renderHome from '../services/homeService.js';

const router = Router();

router.get('/', renderHome);

export default router;