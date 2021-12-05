export default {
    // TODO temp (of course)
    // To get a new token:
    // Visit: http://localhost:9001/User/issueJWT?parameters[username]=tony_x&parameters[email]=tony1542@gmail.com&parameters[id]=1234
    JWT: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3Q6ODA4MCIsImF1ZCI6InRlc3RfYXVkaWVuY2UiLCJpYXQiOjE2Mzg3Mzc5NDcsIm5iZiI6MTYzODczNzk1NywiZXhwIjoxNjM4NzM4MDA3LCJkYXRhIjp7ImlkIjoiMTIzNCIsInVzZXJuYW1lIjoidG9ueV94IiwiZW1haWwiOiJ0b255MTU0MkBnbWFpbC5jb20ifX0.v53Y5kkTATEwLaVIjj8m2uXGYABMAGB4EogpkxJoF70',

    setJWT: function (jwt) {
        this.JWT = jwt;
    }
}