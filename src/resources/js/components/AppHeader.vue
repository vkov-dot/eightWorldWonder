<template>
    <div>
        <div class="logo">
            <img src="/img/logo.jpg">
        </div>
        <nav class="navbar navbar-expand-lg menu-list" id="navbar">
            <div>
                <div class="burger-menu">
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="p-4">
                            <div id="add-to-archive dropdown" v-if="user">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false" id="dropdown-archive">
                                    {{ user.name }}
                                </a>
                                <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink"
                                    data-bs-auth="none">
                                    <li v-if="user && user.admin">
                                        <router-link :to="{ name: 'users.index', params: {} }" class="dropdown-item">
                                            Користувачі
                                        </router-link>
                                    </li>
                                    <li v-if="user && user.admin">
                                        <router-link :to="{ name: 'addInfo', params: {} }" class="dropdown-item">
                                            Опублікувати
                                        </router-link>
                                    </li>
                                    <li>
                                        <span @click="logout" class="dropdown-item">
                                            Вийти
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div id="add-to-archive dropdown dropdown-inline" v-if="user && user.admin">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    Архів
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" archive-menu="none">
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'states.archive'}">
                                            Статті
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'issues.archive'}" class="dropdown-item">
                                            Газета
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'start', params: {} }">
                                    Головна
                                </router-link>
                            </li>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'media.index', params: {} }">
                                    Фото/Відео
                                </router-link>
                            </li>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'states.index', params: {} }">
                                    Статті
                                </router-link>
                            </li>
                            <div id="add-to-archive dropdown dropdown-inline">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    Газета
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'issues.index' }">
                                            Усе
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', params: {id: 1} }" class="dropdown-item">
                                            Випуски
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', params: {id: 2} }" class="dropdown-item">
                                            Біблія
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', params: {id: 3}}" class="dropdown-item">
                                            День народження
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                            <li>
                                <router-link :to="{ name: 'headings.index' }" class="menu-list-link">
                                    Рубрики
                                </router-link>
                            </li>
                        </div>
                    </div>
                    <nav class="navbar navbar-dark">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarToggleExternalContent"
                                    aria-controls="navbarToggleExternalContent" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </nav>
                </div>

                <ul class="menu-list-ul">
                    <li>
                        <router-link :to="{ name: 'start' }" class="menu-list-link">
                            Головна
                        </router-link>
                    </li>
                    <div id="add-to-archive dropdown">
                        <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                            Газета
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'issues.index' }">
                                    Усе
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', params: {id: 1} }" class="dropdown-item">
                                    Випуски
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', params: {id: 2} }" class="dropdown-item">
                                    Біблія
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', params: {id: 3}}" class="dropdown-item">
                                    День народження
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <li>
                        <router-link class="menu-list-link" :to="{name: 'media.index'}">
                            Фото/Відео
                        </router-link>
                    </li>
                    <li>
                        <router-link class="menu-list-link" :to="{ name: 'states.index'}">
                            Статті
                        </router-link>
                    </li>
                    <li>
                        <router-link class="menu-list-link" :to="{ name: 'headings.index' }">
                            Рубрики
                        </router-link>
                    </li>
                </ul>
            </div>

            <div>
                <div class="" id="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item" v-if="!user">
                            <router-link :to="{ name: 'login'}" class="menu-list-link">
                                Увійти
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="!user">
                            <router-link :to="{ name: 'register' }" class="menu-list-link">
                                Реєстрація
                            </router-link>
                        </li>
                        <div id="add-to-archive dropdown" class="display-none" v-if="user && user.admin">
                            <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                                Архів
                            </a>
                            <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <router-link class="dropdown-item" :to="{ name: 'states.archive'}">
                                        Статті
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'issues.archive'}" class="dropdown-item">
                                        Газета
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="nav-item" v-if="user">
                            <div id="add-to-archive dropdown" class="display-none">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ user.name }}
                                </a>
                                <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink">
                                    <li v-if="user && user.admin">
                                        <router-link :to="{ name: 'users.index' }" class="dropdown-item">
                                            Користувачі
                                        </router-link>
                                    </li>
                                    <li v-if="user && user.admin">
                                        <router-link :to="{ name: 'addInfo' }" class="dropdown-item">
                                            Опублікувати
                                        </router-link>
                                    </li>
                                    <li>
                                        <span @click="logout" class="dropdown-item">
                                            Вийти
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
    name: "AppHeader",
    computed: mapGetters("auth", ["user","apiToken"]),
    methods: {
        ...mapActions("auth", ["sendLogoutRequest"]),
        logout() {
            this.sendLogoutRequest()
        }
    }
}
</script>
