          <li class="dropdown pc-h-item header-user-profile">
              <a
                  class="pc-head-link dropdown-toggle arrow-none me-0"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-haspopup="false"
                  data-bs-auto-close="outside"
                  aria-expanded="false">
                  <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                  <span><?= $_SESSION["TopicFullname"] ?></span>
              </a>
              <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                  <div class="dropdown-header">
                      <div class="d-flex mb-1">
                          <div class="flex-shrink-0">
                              <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35">
                          </div>
                          <div class="flex-grow-1 ms-3">
                              <h6 class="mb-1"><?= $_SESSION["TopicFullname"] ?></h6>
                              <span><?= $_SESSION["TopicPosition"] ?></span>
                          </div>
                          <a href="../auth/logout.php" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
                      </div>
                  </div>
                  <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button
                              class="nav-link active"
                              id="drp-t1"
                              data-bs-toggle="tab"
                              data-bs-target="#drp-tab-1"
                              type="button"
                              role="tab"
                              aria-controls="drp-tab-1"
                              aria-selected="true"><i class="ti ti-user"></i> Profile</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button
                              class="nav-link"
                              id="drp-t2"
                              data-bs-toggle="tab"
                              data-bs-target="#drp-tab-2"
                              type="button"
                              role="tab"
                              aria-controls="drp-tab-2"
                              aria-selected="false"><i class="ti ti-settings"></i> Setting</button>
                      </li>
                  </ul>
                  <div class="tab-content" id="mysrpTabContent">
                      <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-edit-circle"></i>
                              <span>Edit Profile</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-user"></i>
                              <span>View Profile</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-clipboard-list"></i>
                              <span>Social Profile</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-wallet"></i>
                              <span>Billing</span>
                          </a>
                          <a href="../auth/logout.php" class="dropdown-item">
                              <i class="ti ti-power"></i>
                              <span>Logout</span>
                          </a>
                      </div>
                      <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-help"></i>
                              <span>Support</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-user"></i>
                              <span>Account Settings</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-lock"></i>
                              <span>Privacy Center</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-messages"></i>
                              <span>Feedback</span>
                          </a>
                          <a href="#!" class="dropdown-item">
                              <i class="ti ti-list"></i>
                              <span>History</span>
                          </a>
                      </div>
                  </div>
              </div>
          </li>