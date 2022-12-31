import passport from 'passport';
import * as GoogleStrategy from 'passport-google-oauth2';
import dotenv from 'dotenv';

dotenv.config();

passport.use(new GoogleStrategy.Strategy({
    clientID:     process.env.GOOGLE_ID,
    clientSecret: process.env.GOOGLE_SECRET,
    callbackURL: "http://localhost:8080/api/auth/google/callback",
    passReqToCallback: true
  }, (_, __, ___, profile, done) => {
    return done(null, profile);
  }
));

passport.serializeUser((user, done) => {
  done(null, user);
});

passport.deserializeUser((user, done) => {
  done(null, user);
});

export default passport;