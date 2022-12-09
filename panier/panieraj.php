


<form action="#?id=<?=$idp;?>" method="POST">
                          <div class="d-flex flex-row">
                            <button class="btn btn-link px-2" name="moins" type="submit"
                              onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                              <i class="fas fa-minus"></i>
                            </button>

                            <input id="form1" min="0" name="quantity" value="<?= $_SESSION['panier'][$product->id_produit]; ?>" type="number"
                              class="form-control form-control-sm" style="width: 50px;" />

                            <button class="btn btn-link px-2" name="plus" type="submit"
                              onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                              <i class="fas fa-plus"></i>
                            </button>
                        </div>
                       </form>