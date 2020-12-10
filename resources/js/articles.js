import articlesList from './components/articles/List.vue';
import articlesEdit from './components/articles/Edit.vue';
import axios from 'axios';

let app = new Vue({
    el: '#app',
    components: {
        'articles-list': articlesList,
        'articles-edit': articlesEdit
    },
    data: {
        editTitle: '',
        isAdd: false,
        showEdit: false,
        params: {
            'id': '',
            'title': '',
            'content': '',
            'slug': ''
        },
        url: 'https://my-json-server.typicode.com/coolgood88142/json_server/articles',
        articles: [],
        articlesDataIndex: null
    },
    mounted() {
        this.getArticlesData()
        // this.getPutArticlesData()
    },
    methods: {
        getPutArticlesData(){
            axios.put(this.url, { id:1, title:'test', content:'Testcontent', slug: 'test' })
            .then(
                response => (
                    console.log(response)
                )
            )
            .catch(error => {
                console.log(error)
            })
        },
        getPatchArticlesData(){
            axios.patch(this.url)
            .then(
                response => (
                    console.log(response)
                )
            )
            .catch(error => {
                console.log(error)
            })
        },
        getDeleteArticlesData(){
            axios.delete(this.url, )
            .then(
                response => (
                    console.log(response)
                )
            )
            .catch(error => {
                console.log(error)
            })
        },
        getArticlesData(){
            axios.get(this.url)
            .then(
                response => (
                    this.articles = response.data
                )
            )
            .catch(error => {
                console.log(error)
            })
        },
        getAddArticles() {
            this.editTitle = '新增文章'
            this.showEdit = true
            this.isAdd = true
            this.params = {
                'id': '',
                'title': '',
                'content': '',
                'slug': ''
            }
        },
        updateArticles(id, title, content, slug, index) {
            this.editTitle = '更新文章'
            this.showEdit = true
            this.params = {
                'id': id,
                'title': title,
                'content': content,
                'slug': slug
            }
            this.articlesDataIndex = index
            this.isAdd = false
        },
        updateArticlesData(params) {
            if (this.articlesDataIndex != null) {
                this.articles[this.articlesDataIndex].title = params.title
                this.articles[this.articlesDataIndex].content = params.content
                this.articles[this.articlesDataIndex].slug = params.slug
            }else{
                this.articles.push(params)
                this.articlesDataIndex = params.id-1
            }
        },
        deleteArticlesData(index) {
            this.articlesDataIndex = index
            if (this.articlesDataIndex != null) {
                this.articles.splice(this.articlesDataIndex, 1)
            }
        },
        isShowMessage(isSuccess, message){
            swal({
                title: message,
                confirmButtonColor: "#e6b930",
                icon: isSuccess ? 'success':'error',
                showCloseButton: true
            })

            if (isSuccess) {
                this.showEdit = false
            }
        }
    },
    
})