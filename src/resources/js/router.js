import Vue from 'vue'
import VueRouter from 'vue-router'
import StartPage from "./components/StartPage.vue";
import StateShowPage from "./components/pages/StateShowPage";
import StatesIndexPage from "./components/pages/StatesIndexPage";
import IssuesIndexPage from "./components/pages/IssuesIndexPage";
import MediaIndexPage from "./components/pages/MediaIndexPage.vue";
import HeadingsIndexPage from "./components/pages/HeadingsIndexPage";
import addInfoPage from "./components/pages/addInfoPage";
import UsersIndexPage from "./components/pages/UsersIndexPage";
import HeadingsShowPage from "./components/pages/HeadingsShowPage";
import CategoryShowPage from "./components/pages/CategoryShowPage";
import LoginPage from "./components/pages/LoginPage";
import IssuesCreatePage from "./components/pages/IssuesCreatePage";
import StatesCreatePage from "./components/pages/StatesCreatePage";
import FolderCreatePage from "./components/pages/FolderCreatePage";
import HeadingsCreatePage from "./components/pages/HeadingsCreatePage";
import StatesArchivePage from "./components/pages/StatesArchivePage";
import IssuesArchivePage from "./components/pages/IssuesArchivePage";
import RegisterPage from "./components/pages/RegisterPage";
import ProfileEditPage from "./components/pages/ProfileEditPage";
import StateEditPage from "./components/pages/StateEditPage";
import HeadingEditPage from "./components/pages/HeadingEditPage";
import FolderEditPage from "./components/pages/FolderEditPage";
import admin from './middleware/admin';

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'start',
            component: StartPage,
            props: true,
        }, {
            path: '/states/show/:state',
            name: 'states.show',
            component: StateShowPage,
            props: true,
        }, {
            path: '/states',
            name: 'states.index',
            component: StatesIndexPage,
        }, {
            path: '/states/edit/:state',
            name: 'states.edit',
            component: StateEditPage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/issues',
            name: 'issues.index',
            component: IssuesIndexPage,
        }, {
            path: '/issues/categories/:id',
            name: 'categories.show',
            component: CategoryShowPage,
        }, {
            path: '/media',
            name: 'media.index',
            component: MediaIndexPage,
        }, {
            path: '/headings',
            name: 'headings.index',
            component: HeadingsIndexPage,
        }, {
            path: '/headings/show/:heading',
            name: 'headings.show',
            component: HeadingsShowPage,
        }, {
            path: '/archived/states',
            name: 'states.archive',
            component: StatesArchivePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/archived/issues',
            name: 'issues.archive',
            component: IssuesArchivePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/addInfo',
            name: 'addInfo',
            component: addInfoPage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/users',
            name: 'users.index',
            component: UsersIndexPage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/login',
            name: 'login',
            component: LoginPage,
        }, {
            path: '/issues/create',
            name: 'issues.create',
            component: IssuesCreatePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/states/create',
            name: 'states.create',
            component: StatesCreatePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/media/create',
            name: 'media.create',
            component: FolderCreatePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/media/:folder/edit',
            name: 'media.edit',
            component: FolderEditPage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/headings/:heading/edit',
            name: 'headings.edit',
            component: HeadingEditPage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/headings/create',
            name: 'headings.create',
            component: HeadingsCreatePage,
            meta: {
                middleware: admin,
            }
        }, {
            path: '/register',
            name: 'register',
            component: RegisterPage,
        }, {
            path: '/profile/:user/edit',
            name: 'profile.edit',
            component: ProfileEditPage,
            meta: {
                middleware: admin,
            }
        }
    ]
})


function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    if (!subsequentMiddleware) return context.next;
    return (...parameters) => {
        context.next(...parameters);
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({...context, next: nextMiddleware});
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];
        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({...context, next: nextMiddleware});
    }

    return next();
});

export default router;
