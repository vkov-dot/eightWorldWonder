import Vue from 'vue'
import VueRouter  from 'vue-router'
import StartPage from "./components/StartPage.vue";
import StateShowPage from "./components/pages/StateShowPage";
import StatesIndexPage from "./components/pages/StatesIndexPage";
import IssuesIndexPage from "./components/pages/IssuesIndexPage";
import MediaIndexPage from "./components/pages/MediaIndexPage.vue";
import HeadingsIndexPage from "./components/pages/HeadingsIndexPage";
import ArchivePage from "./components/pages/ArchivePage";
import ProfileShowPage from "./components/pages/ProfileShowPage";
import addInfoPage from "./components/pages/addInfoPage";
import UsersIndexPage from "./components/pages/UsersIndexPage";
import HeadingsShowPage from "./components/pages/HeadingsShowPage";
import CategoryShowPage from "./components/pages/CategoryShowPage";

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'start',
            component: StartPage,
            props: true,
        },
        {
            path: '/states/:state',
            name: 'states.show',
            component: StateShowPage,
            props: true,
        },
        {
            path: '/states',
            name: 'states.index',
            component: StatesIndexPage,
        },
        {
            path: '/issues',
            name: 'issues.index',
            component: IssuesIndexPage,
        },
        {
            path: '/issues/categories/:id',
            name: 'categories.show',
            component: CategoryShowPage,
        },
        {
            path: '/media',
            name: 'media.index',
            component: MediaIndexPage,
        },
        {
            path: '/headings',
            name: 'headings.index',
            component: HeadingsIndexPage,
        },
        {
            path: '/headings/:heading',
            name: 'headings.show',
            component: HeadingsShowPage,
        },
        {
            path: '/archive/:table',
            name: 'archive',
            component: ArchivePage,
        },
        {
            path: '/addInfo',
            name: 'addInfo',
            component: addInfoPage,
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndexPage,
        },
        {
            path: '/profile',
            name: 'profile.show',
            component: ProfileShowPage
        }
    ]
})

