class User {

    id: string;
    
    email: string;

    picture: string;

    provider: string;

    constructor(id: string, email: string, picture: string, provider: string) {
        this.id = id;
        this.email = email;
        this.picture = picture;
        this.provider = provider;
    }
}

export default User;