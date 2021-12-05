export default {
    // TODO temp (of course)
    // To get a new token:
    // Visit: http://localhost:9001/User/issueJWT?parameters[username]=tony_x&parameters[email]=tony1542@gmail.com&parameters[id]=1234
    JWT: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3Q6ODA4MCIsImF1ZCI6InRlc3RfYXVkaWVuY2UiLCJpYXQiOjE2Mzg3Mzk4NzMsIm5iZiI6MTYzODczOTg3MywiZXhwIjoxNjM4NzQzNDczLCJkYXRhIjp7ImlkIjoiMTIzNCIsInVzZXJuYW1lIjoidG9ueV94IiwiZW1haWwiOiJ0b255MTU0MkBnbWFpbC5jb20ifX0.KSpHB4pK3ibVriIXGwP8fgJ4gYOq62IrxoeOAPxg8ug',

    setJWT: function (jwt) {
        this.JWT = jwt;
    }
}