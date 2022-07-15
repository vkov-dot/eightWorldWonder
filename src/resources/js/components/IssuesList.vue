<template>
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
<!--                <form method="post" enctype="multipart/form-data" action="{{ route('issues.search') }}" class="col-12">
                    @csrf
                    <div class="col-12 search-div">
                        <input type="text" name="param" placeholder="Назва випуску"
                               class="add-heading-input @error('name') is-invalid @enderror search-issue-input">
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </form>
                @if($issues->count())-->
                <div>
                    <div class="notes-list-div states-list">
                        <ul>
                            <issues-list-element
                                v-for="issue in category"
                                :key="issue.id"
                                :issue="issue"
                                class="list-element"
                            />
                        </ul>
                    </div>
<!--                    @if($issues->total() > $issues->count())
                    <div class="row justify-content-center">
                        <div class="pagination-first-parent">
                            <div class="card">
                                <div class="card-body pagination">
                                    {{ $issues->onEachSide(2)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif-->
                </div>
                @endif
            </div>
        </div>
    </div>
</template>

<script>
import IssuesListElement from "./list-elements/IssuesListElement";

export default {
    name: "IssuesList",
    components: {
        IssuesListElement
    },
    props: {
        category: [],
    }
}
</script>

<style scoped>

</style>
