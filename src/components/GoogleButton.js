import supabase from "../config/supabaseClient";

const GoogleButton = () => {

    const handleClick = async () => {
        await supabase.auth.signInWithOAuth({ provider: 'google' });
    };

    return (
        <>
            <img src="google.png" alt="Google logo"></img>
            <button className="btn btn-primary" onClick={handleClick}>Se connecter avec Google</button>
        </>
    );
}

export default GoogleButton;