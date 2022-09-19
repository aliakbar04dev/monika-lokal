<div class="col-lg-9">
    <div>
        <ul>
            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                <h5 class="kuning" style="font-family: 'Poppins'; font-weight:bold;">Invoice</h5>
            </li>
            <li class="white-content pb-4 pt-4 pl-4 pr-4">
                <div id="tempattabel">
                <table id="example" style="font-size:12px;" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Paket</th>
                                <th>Status</th>
                                <th>Kode Pembayaran</th>
                                <th>Pembayaran Exp</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
                            $now = date('Y-m-d H:i:s');
							if(!is_null($bill) && count($bill) > 0){
								foreach($bill as $b){
						?>
                            <tr>
                                <td><?= $b['kode_pembayaran'] ?></td>
                                <td><?= $b['created_at'] ?></td>
                                <td><?= $b['nama_paket'] ?></td>
                                <td>
									<?php
										if($b['status_pembayaran'] == 'payment'){
											echo 'Menunggu Pembayaran';
										}else{
											echo ucfirst($b['status_pembayaran']);
										}
									?>
								</td>
                                <td>
									<?php
										if($b['status_pembayaran'] == 'pending'){
											echo $b['number_code'];
										}else{
											echo '-';
										}
									?>
								</td>
                                <td><?= date('d-m-Y H:i:s', strtotime($b['expire_date'])) ?></td>
                                <td>
                                <a type="button" style="width:auto; font-size:11px;" class="boxed-bil" tabindex="4" href="<?= site_url('/detailpack/'.$b['kode_pembayaran']); ?>">
											Details
										</a>
									<?php
										if($b['status_pembayaran'] == 'payment' && $b['expire_date'] > $now){
									?>
										<a type="button" style="width:auto; font-size:11px;" class="boxed-bil" tabindex="4" href="<?= site_url('/continuepayment/'.$b['kode_pembayaran']); ?>">
											Lanjutkan Pembayaran
										</a>
									<?php
										}
									?>
									
									<!--
                                    <button type="submit" style="width:auto;" class="boxed-b" tabindex="4">
                                        Berhenti Berlangganan
                                    </button>-->
                                </td>
                            </tr>
						<?php
								}
							}
						?>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    </div>
</div>