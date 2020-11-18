export default function ({ store, redirect }) {
    if (store.state.auth.loggedIn) {
      return redirect('/videos')
    } else {
        return redirect('/login')
    }
}