export default function ({ store, redirect }) {
    if (!store.state.auth.loggedIn) {
    //   return redirect('/login')
    }
    console.log(store.state.auth.loggedIn);
    console.log(store.state.auth.user);
}