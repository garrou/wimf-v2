import { useEffect, useState } from 'react';
import Nav from '../../components/Nav';
import supabase from '../../config/supabaseClient';

const Account = () => {
    const [user, setUser] = useState(null);

    useEffect(() => {
        (async () => {
            const { data: { user } } = await supabase.auth.getUser();
            setUser(user);
        })();
    }, []);

    return (
        <>
            <Nav />
            
            {user && <p>{user.id}</p>}
        </>
    );
}

export default Account;