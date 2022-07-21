import auth from '../store/modules/auth'

export default function ({ next, router }) {
    if (!localStorage.getItem("authToken")) {
        return router.push({ name: 'login' });
    }

    return next();
}
