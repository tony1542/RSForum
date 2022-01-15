import jwtDecode from "jwt-decode";

export default {
    JWT: '',
    JWTData: {},
    errors: [],
    waitingOnAjax: false,

    setWaitingOnAjax(boolean) {
        this.waitingOnAjax = boolean;
    },

    setJWT(jwt) {
        this.JWT = jwt;
        this.JWTData = jwtDecode(jwt).data;
    },
    clearJWTAndData() {
        this.JWT = '';
        this.JWTData = {};
    },
    isUserSignedIn() {
        if (!this.JWTData) {
            return false;
        }

        return this.JWTData.id > 0;
    },

    setErrors: function (errors) {
        if (typeof errors === 'string') {
            errors = [errors];
        }

        this.errors = errors;
    },
    clearErrors() {
        this.errors = [];
    }
}