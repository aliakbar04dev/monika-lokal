<div class="col-lg-9">
    <div>
        <ul>
            <li class="white-header pb-3 pt-4 pl-4 -r-4">
                <h5 class="kuning"><?= $title; ?></h5>
            </li>
            <li class="white-content pb-4 pt-4 pl-4 pr-4">
            <div id="tempattabel" style="overflow-x:auto;">
                    <table class="table table-striped" id="tablesaktiresult">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Invoice Date</th>
                                <th>Pakage Name</th>
                                <th>Status</th>
                                <th>Kode Pembayaran</th>
                                <th>Expire</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
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
                                <td><?= date('d-m-Y', strtotime($b['expire_date'])) ?></td>
                                <td style="text-align: center;">
									<?php
										if($b['status_pembayaran'] == 'payment'){
									?>
										<button type="button" style="width:auto;" class="boxed-a" tabindex="4" onclick="window.location.href='<?= site_url('cart/'.$b['kode_paket']); ?>'">
											Bayar Sekarang
										</button>
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