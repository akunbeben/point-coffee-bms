<div style="display: none;" id="typePesan"><?= $this->session->flashdata('typePesan'); ?></div>
<div style="display: none;" id="pesan"><?= $this->session->flashdata('pesan'); ?></div>
<h1 class="h3 mb-2 text-gray-800">POS Kasir</h1>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body" style="height: 140px;">
                        <div class="form-group row">
                            <label for="kasir" class="col-md-4 mt-1">Kasir</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="<?= $kasir->nama; ?>" readonly>
                                <input type="hidden" id="kasir" name="kasir" value="<?= $kasir->nik; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer" class="col-md-4 mt-1">Customer</label>
                            <div class="col-md-8">
                                <select name="customer" id="customer" class="form-control" style="width: 100%;" <?= $pembayaran != null ? 'disabled' : '' ?>>
                                    <?php foreach ($customer as $member) : ?>
                                        <option value="<?= $member->nama; ?>"><?= $member->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body" style="height: 140px;">
                        <form action="<?= base_url('kasir/add-to-cart'); ?>" method="post">
                            <div class="form-group row">
                                <label for="product" class="col-md-3 mt-1">Product</label>
                                <div class="col-md-6">
                                    <select name="product" id="product" class="form-control" style="width: 100%;" required <?= $pembayaran != null ? 'disabled' : '' ?>>
                                        <option value="">Masukkan PLU Product.</option>
                                        <?php foreach ($product as $prd) : ?>
                                            <option value="<?= $prd->id; ?>"><?= $prd->prdcd . ' - ' . $prd->singkatan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantity" class="col-md-3">Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="quantity" id="quantity">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success" <?= $pembayaran != null ? 'disabled' : '' ?>><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($keranjang as $cart) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $cart->prdcd . ' - ' . $cart->singkatan; ?></td>
                                <td><?= rupiah($cart->sellingprice); ?></td>
                                <td><?= $cart->quantity; ?></td>
                                <td class="text-center" style="max-width: 50px;">
                                    <?php if ($pembayaran == null) : ?>
                                        <!-- <button type="button" onclick="jumlahProduct('<?= base_url('kasir/plus-product/') . $cart->id; ?>')" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        <button type="button" onclick="jumlahProduct('<?= base_url('kasir/minus-product/') . $cart->id; ?>')" class="btn btn-warning btn-sm"><i class="fas fa-minus"></i></button> -->
                                        <button type="button" onclick="jumlahProduct('<?= base_url('kasir/delete-product/') . $cart->id; ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="form-group row">
                            <label for="tunai" class="col-md-4 mt-1">Tunai</label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="tunai" name="tunai" style="width: 100%;" placeholder="0" <?= $pembayaran != null ? 'readonly' : '' ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 font-weight-bold text-gray-800">No Struk : </h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <h6 class="mb-0 font-weight-bold text-gray-800"><?= $struk; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <!-- <button class="btn btn-warning btn-lg"><i class="fas fa-retweet"></i> Cancel Order</button> -->
                        <button type="button" onclick="bayar()" class="btn btn-success btn-lg"><i class="fas fa-paper-plane"></i> Process Order</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="form-group row">
                            <label for="nontunai" class="col-md-4 mt-1">Non-Tunai</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="nontunai" name="nontunai" readonly value="<?= $pembayaran != null ? $pembayaran->total : 0; ?>">
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#nontunaiModal"><i class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0 font-weight-bold text-gray-800">Total : </h5>
                            </div>
                            <div class="col-md-8 text-right">
                                <h5 class="mb-0 font-weight-bold text-gray-800"><?= rupiah($totalBelanja); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="nontunaiModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="nontunaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nontunaiModalLabel">Form Pembayaran Non-Tunai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if ($pembayaran != null) : ?>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nontunai_bank" class="col-md-4 mt-1">Bank</label>
                            <div class="col-md-8">
                                <input name="nontunai_banks" id="nontunai_banks" class="form-control" style="width: 100%;" value="<?= $pembayaran->bank; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nontunai_kartu" class="col-md-4 mt-1">No. Kartu</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nontunai_kartu" name="nontunai_kartu" value="<?= $pembayaran->no_kartu; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nontunai_approval" class="col-md-4 mt-1">Appsroval Code</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nontunai_approval" name="nontunai_approval" value="<?= $pembayaran->approval; ?>" readonly>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="nontunai_struk" name="nontunai_struk" value="<?= $pembayaran->no_struk; ?>">
                        <input type="hidden" class="form-control" id="nontunai_total" name="nontunai_total" value="<?= $pembayaran->total; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="submit-nontunai" onclick="NonTunai('<?= base_url('kasir/non_tunai'); ?>')" class="btn btn-primary" disabled>Simpan</button>
                    </div>
                </form>
            <?php else : ?>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nontunai_bank" class="col-md-4 mt-1">Bank</label>
                            <div class="col-md-8">
                                <select name="nontunai_bank" id="nontunai_bank" class="form-control" style="width: 100%;">
                                    <option value="BRI">BRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BCA">BCA</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nontunai_kartu" class="col-md-4 mt-1">No. Kartu</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nontunai_kartu" name="nontunai_kartu">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nontunai_approval" class="col-md-4 mt-1">Appsroval Code</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nontunai_approval" name="nontunai_approval">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="nontunai_struk" name="nontunai_struk" value="<?= $struk; ?>">
                        <input type="hidden" class="form-control" id="nontunai_total" name="nontunai_total" value="<?= $totalBelanja; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="submit-nontunai" onclick="NonTunai('<?= base_url('kasir/non_tunai'); ?>')" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<form action="<?= base_url('kasir/bayar'); ?>" method="post" style="display: none;" id="form-bayar">
    <input type="hidden" name="kasir_struk" id="kasir_struk" value="<?= $struk; ?>">
    <input type="hidden" name="kasir_kasir" id="kasir_kasir">
    <input type="hidden" name="kasir_member" id="kasir_member">
    <input type="hidden" name="kasir_total_belanja" id="kasir_total_belanja" value="<?= $totalBelanja; ?>">
    <input type="hidden" name="kasir_total_bayar" id="kasir_total_bayar">
    <input type="hidden" name="kasir_keuntungan" id="kasir_keuntungan" value="<?= $keuntungan; ?>">
    <input type="hidden" name="kasir_kembalian" id="kasir_kembalian">
</form>