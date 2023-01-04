import supabase from "../config/supabaseClient";

const GoogleAuth = () => {

    const handleClick = async () => {
        await supabase.auth.signInWithOAuth({ provider: 'google' });
    };

    return (
        <>
            <button onClick={handleClick} className="btn btn-primary">
                <img src="google.png" alt="Logo Google" width="25" height="25" />
                &nbsp;Se connecter avec Google
            </button>
        </>
    );
}

export default GoogleAuth;