<style>
    .camera-icon {
        background-image: url("{{ asset('/vendor/webkul/ui/assets/images/Camera.svg') }}");
    }
</style>

<script type="text/x-template" id="cart-btn-template">
    <button
        type="button"
        id="mini-cart"
        @click="toggleMiniCart"
        :class="`btn btn-link disable-box-shadow ${itemCount == 0 ? 'cursor-not-allowed' : ''}`">

        <div class="mini-cart-content">
            <i class="material-icons-outlined text-down-3">shopping_cart</i>
            <span class="badge" v-text="itemCount" v-if="itemCount != 0"></span>
            <span class="fs18 fw6 cart-text">{{ __('velocity::app.minicart.cart') }}</span>
        </div>
        <div class="down-arrow-container">
            <span class="rango-arrow-down"></span>
        </div>
    </button>
</script>

<script type="text/x-template" id="close-btn-template">
    <button type="button" class="close disable-box-shadow">
        <span class="white-text fs20" @click="togglePopup">×</span>
    </button>
</script>

<script type="text/x-template" id="quantity-changer-template">
    <div :class="`quantity control-group ${errors.has(controlName) ? 'has-error' : ''}`">
        <label class="required">{{ __('shop::app.products.quantity') }}</label>
        <button type="button" class="decrease" @click="decreaseQty()">-</button>

        <input
            :value="qty"
            class="control"
            :name="controlName"
            :v-validate="validations"
            data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;"
            readonly />

        <button type="button" class="increase" @click="increaseQty()">+</button>

        <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
    </div>
</script>

@include('velocity::UI.header')

<script type="text/x-template" id="logo-template">
    <a
        :class="`left ${addClass}`"
        href="{{ route('shop.home.index') }}">

        @if ($logo = core()->getCurrentChannel()->logo_url)
            <img class="logo" src="{{ $logo }}"/>
        @else
            <img class="logo" src="{{ asset('themes/velocity/assets/images/logo-text.png') }}" />
        @endif
    </a>
</script>

<script type="text/x-template" id="searchbar-template">
    <div class="row no-margin right searchbar">
        <div class="col-lg-5 col-md-12 no-padding input-group">
            <form
                method="GET"
                role="search"
                id="search-form"
                action="{{ route('velocity.search.index') }}">

                <div
                    class="btn-toolbar full-width"
                    role="toolbar">

                    <div class="btn-group full-width">
                        <div class="selectdiv">
                            <select class="form-control fs13 styled-select" name="category" @change="focusInput($event)">
                                <option value="">
                                    {{ __('velocity::app.header.all-categories') }}
                                </option>

                                <template v-for="(category, index) in $root.sharedRootCategories">
                                    <option
                                        :key="index"
                                        selected="selected"
                                        :value="category.id"
                                        v-if="(category.id == searchedQuery.category)">
                                        @{{ category.name }}
                                    </option>

                                    <option :key="index" :value="category.id" v-else>
                                        @{{ category.name }}
                                    </option>
                                </template>
                            </select>

                            <div class="select-icon-container">
                                <span class="select-icon rango-arrow-down"></span>
                            </div>
                        </div>

                        <div class="full-width">

                            <input
                                required
                                name="term"
                                type="search"
                                class="form-control"
                                placeholder="{{ __('velocity::app.header.search-text') }}"
                                :value="searchedQuery.term ? searchedQuery.term.split('+').join(' ') : ''" />

                            <image-search-component></image-search-component>

                            <button class="btn" type="submit" id="header-search-icon">
                                <i class="fs16 fw6 rango-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-lg-7 col-md-12">
            {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}
                @include('shop::checkout.cart.mini-cart')
            {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}

            @php
                $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false
            @endphp

            {!! view_render_event('bagisto.shop.layout.header.compare.before') !!}
                @if ($showCompare)
                    <a
                        class="compare-btn unset"
                        @auth('customer')
                            href="{{ route('velocity.customer.product.compare') }}"
                        @endauth

                        @guest('customer')
                            href="{{ route('velocity.product.compare') }}"
                        @endguest
                        >

                        <i class="material-icons">compare_arrows</i>
                        <div class="badge-container" v-if="compareCount > 0">
                            <span class="badge" v-text="compareCount"></span>
                        </div>
                        <span>{{ __('velocity::app.customer.compare.text') }}</span>
                    </a>
                @endif
            {!! view_render_event('bagisto.shop.layout.header.compare.after') !!}

            {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}
                <a class="wishlist-btn unset" :href="`${isCustomer ? '{{ route('customer.wishlist.index') }}' : '{{ route('velocity.product.guest-wishlist') }}'}`">
                    <i class="material-icons">favorite_border</i>
                    <div class="badge-container" v-if="wishlistCount > 0">
                        <span class="badge" v-text="wishlistCount"></span>
                    </div>
                    <span>{{ __('shop::app.layouts.wishlist') }}</span>
                </a>
            {!! view_render_event('bagisto.shop.layout.header.wishlist.after') !!}
        </div>
    </div>
</script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet"></script>

<script type="text/x-template" id="image-search-component-template">
    <div class="d-inline-block">
        <label class="image-search-container" for="image-search-container">
            <i class="icon camera-icon"></i>

            <input
                type="file"
                class="d-none"
                ref="image_search_input"
                id="image-search-container"
                v-on:change="uploadImage()" />

            <img
                class="d-none"
                id="uploaded-image-url"
                :src="uploadedImageUrl" />
        </label>
    </div>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('cart-btn', {
            template: '#cart-btn-template',

            props: ['itemCount'],

            methods: {
                toggleMiniCart: function () {
                    let modal = $('#cart-modal-content')[0];
                    if (modal)
                        modal.classList.toggle('hide');

                    let accountModal = $('.account-modal')[0];
                    if (accountModal)
                        accountModal.classList.add('hide');

                    event.stopPropagation();
                }
            }
        });

        Vue.component('close-btn', {
            template: '#close-btn-template',

            methods: {
                togglePopup: function () {
                    $('#cart-modal-content').hide();
                }
            }
        });

        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',
            inject: ['$validator'],
            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                },

                minQuantity: {
                    type: [Number, String],
                    default: 1
                },

                validations: {
                    type: String,
                    default: 'required|numeric|min_value:1'
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > this.minQuantity)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        Vue.component('logo-component', {
            template: '#logo-template',
            props: ['addClass'],
            methods: {
                isMobil : function() {
                    let check = false;
                    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                    return check;
                }
            }
        });

        Vue.component('searchbar-component', {
            template: '#searchbar-template',
            data: function () {
                return {
                    compareCount: 0,
                    wishlistCount: 0,
                    searchedQuery: [],
                    isCustomer: '{{ auth()->guard('customer')->user() ? "true" : "false" }}' == "true",
                }
            },

            watch: {
                '$root.headerItemsCount': function () {
                    this.updateHeaderItemsCount();
                }
            },

            created: function () {
                let searchedItem = window.location.search.replace("?", "");
                searchedItem = searchedItem.split('&');

                let updatedSearchedCollection = {};

                searchedItem.forEach(item => {
                    let splitedItem = item.split('=');
                    updatedSearchedCollection[splitedItem[0]] = decodeURI(splitedItem[1]);
                });

                if (updatedSearchedCollection['image-search'] == 1) {
                    updatedSearchedCollection.term = '';
                }

                this.searchedQuery = updatedSearchedCollection;

                this.updateHeaderItemsCount();
            },

            methods: {
                'focusInput': function (event) {
                    $(event.target.parentElement.parentElement).find('input').focus();
                },

                'updateHeaderItemsCount': function () {
                    if (! this.isCustomer) {
                        let comparedItems = this.getStorageValue('compared_product');
                        let wishlistedItems = this.getStorageValue('wishlist_product');

                        if (wishlistedItems) {
                            this.wishlistCount = wishlistedItems.length;
                        }

                        if (comparedItems) {
                            this.compareCount = comparedItems.length;
                        }
                    } else {
                        this.$http.get(`${this.$root.baseUrl}/items-count`)
                            .then(response => {
                                this.compareCount = response.data.compareProductsCount;
                                this.wishlistCount = response.data.wishlistedProductsCount;
                            })
                            .catch(exception => {
                                console.log(this.__('error.something_went_wrong'));
                            });
                    }
                }
            }
        });

        Vue.component('image-search-component', {
            template: '#image-search-component-template',
            data: function() {
                return {
                    uploadedImageUrl: ''
                }
            },

            methods: {
                uploadImage: function() {
                    var imageInput = this.$refs.image_search_input;

                    if (imageInput.files && imageInput.files[0]) {
                        if (imageInput.files[0].type.includes('image/')) {
                            this.$root.showLoader();

                            var formData = new FormData();

                            formData.append('image', imageInput.files[0]);

                            axios.post(
                                "{{ route('shop.image.search.upload') }}",
                                formData,
                                {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }
                            ).then(response => {
                                var net;
                                var self = this;
                                this.uploadedImageUrl = response.data;


                                async function app() {
                                    var analysedResult = [];

                                    var queryString = '';

                                    net = await mobilenet.load();

                                    const imgElement = document.getElementById('uploaded-image-url');

                                    try {
                                        const result = await net.classify(imgElement);

                                        result.forEach(function(value) {
                                            queryString = value.className.split(',');

                                            if (queryString.length > 1) {
                                                analysedResult = analysedResult.concat(queryString)
                                            } else {
                                                analysedResult.push(queryString[0])
                                            }
                                        });
                                    } catch (error) {
                                        self.$root.hideLoader();

                                        window.showAlert(
                                            `alert-danger`,
                                            this.__('shop.general.alert.error'),
                                            "{{ __('shop::app.common.error') }}"
                                        );
                                    }

                                    localStorage.searchedImageUrl = self.uploadedImageUrl;

                                    queryString = localStorage.searched_terms = analysedResult.join('_');

                                    self.$root.hideLoader();

                                    window.location.href = "{{ route('shop.search.index') }}" + '?term=' + queryString + '&image-search=1';
                                }

                                app();
                            }).catch(() => {
                                this.$root.hideLoader();

                                window.showAlert(
                                    `alert-danger`,
                                    this.__('shop.general.alert.error'),
                                    "{{ __('shop::app.common.error') }}"
                                );
                            });
                        } else {
                            imageInput.value = '';

                            alert('Only images (.jpeg, .jpg, .png, ..) are allowed.');
                        }
                    }
                }
            }
        });
    })()
</script>