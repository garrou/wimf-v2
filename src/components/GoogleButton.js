import supabase from "../config/supabaseClient";

const GoogleButton = () => {

    const handleClick = async () => {
        await supabase.auth.signInWithOAuth({ provider: 'google' });
    };

    return (
        <>
            <button className="btn btn-primary" onClick={handleClick}>Se connecter avec Google</button>
        </>
    );
}

export default GoogleButton;