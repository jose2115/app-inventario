
export default () => ({
    status: 'authenticating', // 'authenticated','not-authenticated', 'authenticating'
    user: null,
    userImage: '',
    token: null,
    refreshToken: null,
    messageError:'',
    permission: [],
    roles:[],
    notification: []
})