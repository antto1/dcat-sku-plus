<div class="{{$viewClass['form-group']}}">

    <label for="{{$id ?? ''}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">
        <div class="sku_wrap {{$class}}">
            <input type="hidden" class="Js_sku_input" name="{{$name}}" value="{{old($column, $value)}}">
            <input type="hidden" class="Js_sku_params_input" value="{{$extra_column}}">
            <input type="hidden" class="upload_url" value="{{$uploadUrl}}">
            <input type="hidden" class="delete_url" value="{{$deleteUrl}}">
            <input type="hidden" class="sku_attributes" value='@json($skuAttributes)'>
            <input type="hidden" class="_csrf_token" value="{{csrf_token()}}">

            <div class="sku_card shadow p-2">
                <p>规格名与规格值</p>
                <div class="sku_attr_key_val">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 200px">规格名</th>
                            <th>规格值</th>
                            <th style="width: 100px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control _normal_ attribute_selector">
                                    <option value="">-- 请选择SKU --</option>
                                    @foreach($skuAttributes as $key => &$attribute)
                                        <option value="{{$attribute->attr_type}}" data-idx="{{$key}}">{{$attribute->attr_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="sku_attr_val_wrap">
                                </div>
                            </td>
                            <td>
                                <div class="sku_attr_val_wrap">
                                    <span class="btn btn-default Js_remove_attr_name">移除</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end"><span class="btn btn-primary Js_add_attr_name my-2 mr-1">新增 SKU 条目</span><span class="btn btn-primary Js_save_sku my-2">保存</span></div>
            </div>
            <!-- 操作SKU -->
            <div class="sku_card shadow p-2 mt-2">
                <p>库存与价格</p>
                <div class="sku_edit_wrap">
                    <table class="table table-bordered">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            
        </div>

    </div>
</div>

<style>
    .sku_wrap .sku_edit_wrap .Js_sku_del_pic {
        color: {{ Admin::color()->get('cyan') }};
    }

    .sku_wrap .sku_edit_wrap .Js_sku_upload {
        border: 1px solid {{ Admin::color()->get('input-border') }};
        color: {{ Admin::color()->get('dark70') }};
    }

    .sku_wrap .sku_edit_wrap tr td .icon-x {
        color: {{ Admin::color()->get('danger') }};
    }

    .sku_wrap .flex-wrap {
        margin-top: 7px;
    }

</style>
