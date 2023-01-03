import { Router } from 'express';
import { renderAuth, getGoogleAuthUrl, googleCallback } from '../services/authService.js';

const router = Router();

router.get('/', renderAuth);

router.get('/google', getGoogleAuthUrl);

router.get('/google/callback', googleCallback);

export default router;