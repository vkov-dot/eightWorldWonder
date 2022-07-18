<template>
    <div>
        <div v-if="this.allMedias.length">
            <index-media-list :medias="this.allMedias"/>
        </div>
        <Pagination
            :total="totalMedias"
            :item="10"
            @page-changed="getAllMedias"
        />
    </div>
</template>

<script>

import IndexMediaList from '../IndexMediaList'
import {mapActions, mapGetters} from 'vuex'
import Pagination from "../Pagination";

export default {
    name: "MediaIndexPage",
    data() {
        return {
            page: 1,
        }
    },
    components: {
        IndexMediaList, Pagination
    },
    computed: mapGetters('media', ['allMedias', 'totalMedias']),
    methods: {
        ...mapActions('media', ['getAllMedias']),
    },
    mounted() {
        this.getAllMedias(this.page);
    }
}
</script>
