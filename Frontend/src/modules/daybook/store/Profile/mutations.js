

export const setProfile = ( state, profile ) => {
    state.profile = ''
    state.profile = profile
    state.isLoading = false
}

export const setImage = (state, image) => {
    state.image = ''
    state.image = image
}


export const messageError = (state, data) => {

    state.messageError.password = data

}
