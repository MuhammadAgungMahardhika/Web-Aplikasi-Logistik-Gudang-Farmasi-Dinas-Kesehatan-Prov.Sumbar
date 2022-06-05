                                

                                            <!-- Awal edit no masuk  tanggal_masuk dan pengirim-->

                                                 <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Tanggal masuk</span>
                                                            <input type="date" name="tanggal_masuk"  value="<?= $tanggal_masuk?>" class="form-control" autocomplete="off" required> 
                                                          </div>

                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Pengirim</span>
                                                            <input type="text" name="nama_barang"  value="<?= $pengirim ?>" class="form-control" autocomplete="off" required> 
                                                          </div>
                                                        <!-- Akhir edit no masuk tanggal masuk dan pengirim -->


                                                         <td class="text-center"><?= date("d-m-Y",strtotime($tanggal_masuk)); ?></td>
                                                  <td class=""><?=$pengirim; ?></td>


                                                  <!-- awal tambah no masuk -->
                                                               <div class="input-group mb-3">
                                                 <span class="input-group-text" style="width: 9rem;">Tanggal masuk</span>
                                                  <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?= date('Y-m-d');?>" class="form-control" autocomplete="off" required> 
                                        </div>
                                               <div class="input-group mb-3">
                                                            <span class="input-group-text" style="width: 9rem;">No stock masuk</span>
                                                             <input type="text" name="no_stock_masuk" id="no_stock"  class="form-control" autocomplete="off" required> 
                                                 </div>

                                                 <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">Pengirim</span>

                                                <input type="text" name="pengirim" id="pengirim"  class="form-control" autocomplete="off" required>
                                        </div>


                                                  <!-- akhir tambah no masuk -->