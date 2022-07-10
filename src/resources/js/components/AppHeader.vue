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
                            <!--
                                                            @auth()
                            -->
                            <div id="add-to-archive dropdown">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false" id="dropdown-archive">
                                    <!--
                                                                            {{ user.name }}
                                    -->
                                </a>
                                <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink"
                                    data-bs-auth="none">
                                    <li>
                                        <router-link :to="{ name: 'profile.show', params: {} }" class="dropdown-item">
                                            Профіль
                                        </router-link>
                                    </li>
                                    <!--
                                                                            @if(Auth::user()->admin)
                                    -->
                                    <li>
                                        <router-link :to="{ name: 'users.index', params: {} }" class="dropdown-item">
                                            Користувачі
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'addInfo', params: {} }" class="dropdown-item">
                                            Опублікувати
                                        </router-link>
                                    </li>
                                    <!--
                                                                            @endif
                                    -->
                                    <!--                                        <li>
                                                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    Вийти
                                                                                </a>
                                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>-->
                                </ul>
                            </div>
                            <!--
                                                            @endauth
                            -->
                            <div id="add-to-archive dropdown dropdown-inline">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <!--
                                                                           id="{{ this.$route.name = 'archived.show' ? 'dropdownMenuLink' : '' }}">
                                    -->
                                    Архів
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" archive-menu="none">
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'archive.states', params: {} }">
                                            Статті
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'archive.issues', params: {} }">
                                            Газета
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'start', params: {} }">
                                    <!--
                                                                           id="{{ this.$route.name === 'start' ? 'active-url' : '' }}">
                                    -->
                                    Головна
                                </router-link>
                            </li>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'media.index', params: {} }">
                                    <!--
                                                                           id="{{ this.$route.name === 'media.index' ? 'active-url' : '' }}">
                                    -->
                                    Фото/Відео
                                </router-link>
                            </li>
                            <li>
                                <router-link class="menu-list-link" :to="{ name: 'states.index', params: {} }">
                                    <!--
                                                                           id="{{ this.$route.name === 'states.index' ? 'active-url' : '' }}">
                                    -->
                                    Статті
                                </router-link>
                            </li>
                            <div id="add-to-archive dropdown dropdown-inline">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!--
                                                                           id="{{ (request()->route()->getName() === 'categories.show') ? 'dropdownMenuLink' : '' }}">
                                    -->
                                    Газета
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'issues.index' }">
                                            Усе
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', category: '1' }" class="dropdown-item">
                                            Випуски
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', category:'2' }" class="dropdown-item">
                                            Біблія
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'categories.show', category:'3' }" class="dropdown-item">
                                            День народження
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                            <li>
                                <router-link :to="{ name: 'headings.index' }" class="menu-list-link">
                                    <!--
                                                                           id="{{ (request()->route()->getName() === 'headings.index') ? 'active-url' : '' }}">
                                    -->
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
                            <!--
                                                           id="{{ (request()->route()->getName() === 'start.index') ? 'active-url' : '' }}">
                            -->
                            Головна
                        </router-link>
                    </li>
                    <div id="add-to-archive dropdown">
                        <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--
                                                           id="{{ (request()->route()->getName() === 'categories.show') ? 'dropdownMenuLink' : '' }}">
                            -->
                            Газета
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'issues.index' }">
                                    Усе
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', category: '1' }" class="dropdown-item">
                                    Випуски
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', category:'2' }" class="dropdown-item">
                                    Біблія
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'categories.show', category:'3' }" class="dropdown-item">
                                    День народження
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <li>
                        <router-link class="menu-list-link" :to="{name: 'media.index'}">
                            <!--
                                                           id="{{ (request()->route()->getName() === 'media.index') ? 'active-url' : '' }}">
                            -->
                            Фото/Відео
                        </router-link>
                    </li>
                    <li>
                        <router-link class="menu-list-link" :to="{ name: 'states.index'}">
                            <!--
                                                           id="{{ (request()->route()->getName() === 'states.index') ? 'active-url' : '' }}">
                            -->
                            Статті
                        </router-link>
                    </li>
                    <li>
                        <router-link class="menu-list-link" :to="{ name: 'headings.index' }">
                            <!--
                                                           id="{{ (request()->route()->getName() === 'headings.index') ? 'active-url' : '' }}">
                            -->
                            Рубрики
                        </router-link>
                    </li>
                </ul>
            </div>

            <div>
                <div class="" id="navbar-content">
                    <ul class="navbar-nav">
                        <!--
                                                    @guest
                        -->
                        <li class="nav-item">
                            <router-link :to="{ name: 'login'}" class="menu-list-link">
                                <!--
                                                                    class="menu-list-link {{ (request()->is('login')) ? 'active-url' : '' }}">
                                -->
                                Увійти
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'register' }" class="menu-list-link">
                                <!--
                                                                    class="menu-list-link {{ (request()->is('register')) ? 'active-url' : '' }}"
                                -->
                                Реєстрація
                            </router-link>
                        </li>
                        <!--                            @else
                                                    @if(Auth::user() && Auth::user()->admin)-->
                        <div id="add-to-archive dropdown" class="display-none">
                            <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false">
                                <!--
                                                                   id="dropdown-archive {{ (request()->route()->getName() === 'archived.show') ? 'dropdownMenuLink' : '' }}">
                                -->
                                Архів
                            </a>
                            <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <router-link class="dropdown-item" :to="{ name: 'archive', table: 'states' }">
                                        <!--
                                                                                   href="{{ route('archived.show', ['table' => 'states']) }}">
                                        -->
                                        Статті
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'archive', table: 'issues' }" class="dropdown-item">
                                        <!--
                                                                                   href="{{ route('archived.show', ['table' => 'issues']) }}">
                                        -->
                                        Газета
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <!--                            @endif
                                                    @auth-->
                        <div class="nav-item">
                            <div id="add-to-archive dropdown" class="display-none">
                                <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown"
                                   aria-expanded="false"
                                   id="dropdown-archive">
                                    <!--
                                                                            {{ user.name }}
                                    -->
                                </a>

                                <ul class="dropdown-menu " id="dropdown-archive" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <router-link :to="{ name: 'profile.show' }" class="dropdown-item">
                                            Профіль
                                        </router-link>
                                    </li>
                                    <!--
                                                                            @if(Auth::user()->admin)
                                    -->
                                    <li>
                                        <router-link :to="{ name: 'users.index' }" class="dropdown-item">
                                            Користувачі
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'addInfo' }" class="dropdown-item">
                                            Опублікувати
                                        </router-link>
                                    </li>
                                    <!--                                        @endif-->
                                    <li>
                                        <router-link :to="{ name: 'logout' }" class="dropdown-item"
                                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Вийти
                                        </router-link>
                                        <form id="logout-form" :action="{ name: 'logout' }" method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--                            @endauth
                                                    @endguest-->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "AppHeader"
}
</script>

<style scoped>

</style>
