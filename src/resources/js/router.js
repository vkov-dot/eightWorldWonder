import Vue from 'vue'
import VueRouter  from 'vue-router'
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

Vue.use(VueRouter)

export default new VueRouter({
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
        }, {
            path: '/archived/issues',
            name:  'issues.archive',
            component: IssuesArchivePage
        }, {
            path: '/addInfo',
            name: 'addInfo',
            component: addInfoPage,
        }, {
            path: '/users',
            name: 'users.index',
            component: UsersIndexPage,
        }, {
            path: '/login',
            name: 'login',
            component: LoginPage,
        }, {
            path: '/issues/create',
            name: 'issues.create',
            component: IssuesCreatePage,
        }, {
            path: '/states/create',
            name: 'states.create',
            component: StatesCreatePage,
        }, {
            path: '/media/create',
            name: 'media.create',
            component: FolderCreatePage,
        }, {
            path: '/headings/create',
            name: 'headings.create',
            component: HeadingsCreatePage,
        }, {
            path: '/register',
            name: 'register',
            component: RegisterPage,
        }, {
            path: '/profile/:user/edit',
            name: 'profile.edit',
            component: ProfileEditPage,
        }
    ]
})
