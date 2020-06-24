export default class Gate {

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin'
    }

    isUser(){
        return this.user.type === 'User'
    }
    isAdminOrAuthor(){
        if(this.user.type === 'author' || this.user.type === 'admin'){
            return true;
        }
    }


}