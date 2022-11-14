<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/admin.css">
  <script src="js/admin.js"></script>
</head>

<body>
  <?php include_once "include/nav.inc.php" ?>
  <main>
    <div class="row w-100">
      <div class="col-3">
        <!-- Tab navs -->
        <div class="nav flex-column nav-tabs text-center" id="v-tabs-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" id="v-tabs-FAQ-tab" data-mdb-toggle="tab" href="#v-tabs-FAQ" role="tab"
            aria-controls="v-tabs-FAQ" aria-selected="false">FAQ</a>
          <a class="nav-link active" id="v-tabs-eula4lyf3-tab" data-mdb-toggle="tab" href="#v-tabs-eula4lyf3"
            role="tab" aria-controls="v-tabs-eula4lyf3" aria-selected="true">EULA</a>
          <a class="nav-link" id="v-tabs-return-policy-tab" data-mdb-toggle="tab" href="#v-tabs-return-policy"
            role="tab" aria-controls="v-tabs-return-policy" aria-selected="false">Manage listing</a>
          <a class="nav-link" id="v-tabs-privacy-policy-tab" data-mdb-toggle="tab" href="#v-tabs-privacy-policy" role="tab"
            aria-controls="v-tabs-privacy-policy" aria-selected="false">Manage privacy-policy</a>
          <a class="nav-link" id="v-tabs-reviews-tab" data-mdb-toggle="tab" href="#v-tabs-reviews" role="tab"
            aria-controls="v-tabs-reviews" aria-selected="false">Manage reviews</a>
          <a class="nav-link" id="v-tabs-orders-tab" data-mdb-toggle="tab" href="#v-tabs-orders" role="tab"
            aria-controls="v-tabs-orders" aria-selected="false">Manage orders</a>
        </div>
        <!-- Tab navs -->
      </div>

      <div class="col-9">
        <!-- Tab content -->
        <div class="tab-content" id="v-tabs-tabContent">
          <div class="tab-pane fade show active" id="v-tabs-FAQ" role="tabpanel"
            aria-labelledby="v-tabs-FAQ-tab">
            <h1>FAQ</h1>
            <ul>
            <li>
            <p>Q: What payment methods do you accept?</p>
            <p>A: Credit card and PayPal</p>
            </li>
            <li>
            <p>Q: How can I get a refund?</p>
            <p>A: Check our refund policy and if you think it's suitable for refund, contact us @ admin@shophp.shop</p>
            </li>
            <li>
            <p>Q: Do you ship internationally?</p>
            <p>A: Yes! However, shipping fees may vary depending on which country you live in.</p>
            </li>
            <li>
            <p>Q: How do I track my order?</p>
            <p>A: We will send you an email upon delivering your order. Your order progress will be trackable in the link provided in the email.</p>
            </li>
            <li>
            <p>Q: What happens if I forget my password?</p>
            <p>A: Click the "Reset Password" button and enter your email to reset your password.</p>
            </li>
            <li>
            <p>Q: What happens if the item I want is out of stock?</p>
            <p>A: Too bad. Please select another design or visit our outlets to see if there is available stock</p>
            </li>
            <li>
            <p>Q: Is there a cart size limit?</p>
            <p>A: No, the only limit is your credit card limit :)</p>
            </li>
            <li>
            <p>Q: Do you offer special benefits for members like loyalty points, rewards or discounts?</p>
            <p>A: Yes we do! We have a loyalty system implemented for members.</p>
            </li>
            </ul>
          </div>
          <div class="tab-pane fade" id="v-tabs-return-policy" role="tabpanel"
            aria-labelledby="v-tabs-return-policy-tab">
              <h1>Return and Refund Policy</h1>
              <p>Last updated: November 13, 2022</p>
              <p>Thank you for shopping at shoPHP.</p>
              <p>If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns.</p>
              <p>The following terms are applicable for any products that You purchased with Us.</p>
              <h1>Interpretation and Definitions</h1>
              <h2>Interpretation</h2>
              <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
              <h2>Definitions</h2>
              <p>For the purposes of this Return and Refund Policy:</p>
              <ul>
              <li>
              <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to LeryLoiCompany LLC, Kitchen.</p>
              </li>
              <li>
              <p><strong>Goods</strong> refer to the items offered for sale on the Service.</p>
              </li>
              <li>
              <p><strong>Orders</strong> mean a request by You to purchase Goods from Us.</p>
              </li>
              <li>
              <p><strong>Service</strong> refers to the Website.</p>
              </li>
              <li>
              <p><strong>Website</strong> refers to shoPHP, accessible from <a href="shoPHP.shop" rel="external nofollow noopener" target="_blank">shoPHP.shop</a></p>
              </li>
              <li>
              <p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
              </li>
              </ul>
              <h1>Your Order Cancellation Rights</h1>
              <p>You are entitled to cancel Your Order within 7 days without giving any reason for doing so.</p>
              <p>The deadline for cancelling an Order is 7 days from the date on which You received the Goods or on which a third party you have appointed, who is not the carrier, takes possession of the product delivered.</p>
              <p>In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:</p>
              <ul>
              <li>By email: admin@shophp.shop</li>
              </ul>
              <p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.</p>
              <h1>Conditions for Returns</h1>
              <p>In order for the Goods to be eligible for a return, please make sure that:</p>
              <ul>
              <li>The Goods were purchased in the last 7 days</li>
              <li>The Goods are in the original packaging</li>
              </ul>
              <p>The following Goods cannot be returned:</p>
              <ul>
              <li>The supply of Goods made to Your specifications or clearly personalized.</li>
              <li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.</li>
              <li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.</li>
              <li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.</li>
              </ul>
              <p>We reserve the right to refuse returns of any merchandise that does not meet the above return conditions in our sole discretion.</p>
              <p>Only regular priced Goods may be refunded. Unfortunately, Goods on sale cannot be refunded. This exclusion may not apply to You if it is not permitted by applicable law.</p>
              <h1>Returning Goods</h1>
              <p>You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:</p>
              <p>Kitchen</p>
              <p>We cannot be held responsible for Goods damaged or lost in return shipment. Therefore, We recommend an insured and trackable mail service. We are unable to issue a refund without actual receipt of the Goods or proof of received return delivery.</p>
              <h1>Gifts</h1>
              <p>If the Goods were marked as a gift when purchased and then shipped directly to you, You'll receive a gift credit for the value of your return. Once the returned product is received, a gift certificate will be mailed to You.</p>
              <p>If the Goods weren't marked as a gift when purchased, or the gift giver had the Order shipped to themselves to give it to You later, We will send the refund to the gift giver.</p>
              <h2>Contact Us</h2>
              <p>If you have any questions about our Returns and Refunds Policy, please contact us:</p>
              <ul>
              <li>By email: admin@shophp.shop</li>
              </ul>
          </div>
          <div class="tab-content" id="v-tabs-tabContent">
          <div class="tab-pane fade show active" id="v-tabs-eula4lyf3" role="tabpanel"
            aria-labelledby="v-tabs-eula4lyf3-tab">
            <h1>End-User License Agreement (&quot;Agreement&quot;)</h1>
            <p>Last updated: November 13, 2022</p>
            <p>Please read this End-User License Agreement carefully before being a Karen, downloading or using shoPHP.</p>
            <h1>Interpretation and Definitions</h1>
            <h2>Interpretation</h2>
            <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
            <h2>Definitions</h2>
            <p>For the purposes of this End-User License Agreement:</p>
            <ul>
            <li>
            <p><strong>Agreement</strong> means this End-User License Agreement that forms the entire agreement between You and the Company regarding the use of the Application.</p>
            </li>
            <li>
            <p><strong>Application</strong> means the software program provided by the Company downloaded by You to a Device, named shoPHP</p>
            </li>
            <li>
            <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to LeryLoiCompany LLC, Kitchen.</p>
            </li>
            <li>
            <p><strong>Content</strong> refers to content such as text, images, or other information that can be posted, uploaded, linked to or otherwise made available by You, regardless of the form of that content.</p>
            </li>
            <li>
            <p><strong>Country</strong> refers to:  Singapore</p>
            </li>
            <li>
            <p><strong>Device</strong> means any device that can access the Application such as a computer, a cellphone or a digital tablet.</p>
            </li>
            <li>
            <p><strong>Third-Party Services</strong> means any services or content (including data, information, applications and other products services) provided by a third-party that may be displayed, included or made available by the Application.</p>
            </li>
            <li>
            <p><strong>You</strong> means the individual accessing or using the Application or the company, or other legal entity on behalf of which such individual is accessing or using the Application, as applicable.</p>
            </li>
            </ul>
            <h1>Acknowledgment</h1>
            <p>By clicking the &quot;I Agree&quot; button, downloading or using the Application, You are agreeing to be bound by the terms and conditions of this Agreement. If You do not agree to the terms of this Agreement, do not click on the &quot;I Agree&quot; button, do not download or do not use the Application.</p>
            <p>This Agreement is a legal document between You and the Company and it governs your use of the Application made available to You by the Company.</p>
            <p>The Application is licensed, not sold, to You by the Company for use strictly in accordance with the terms of this Agreement.</p>
            <h1>License</h1>
            <h2>Scope of License</h2>
            <p>The Company grants You a revocable, non-exclusive, non-transferable, limited license to download, install and use the Application strictly in accordance with the terms of this Agreement.</p>
            <p>The license that is granted to You by the Company is solely for your personal, non-commercial purposes strictly in accordance with the terms of this Agreement.</p>
            <h1>Third-Party Services</h1>
            <p>The Application may display, include or make available third-party content (including data, information, applications and other products services) or provide links to third-party websites or services.</p>
            <p>You acknowledge and agree that the Company shall not be responsible for any Third-party Services, including their accuracy, completeness, timeliness, validity, copyright compliance, legality, decency, quality or any other aspect thereof. The Company does not assume and shall not have any liability or responsibility to You or any other person or entity for any Third-party Services.</p>
            <p>You must comply with applicable Third parties' Terms of agreement when using the Application. Third-party Services and links thereto are provided solely as a convenience to You and You access and use them entirely at your own risk and subject to such third parties' Terms and conditions.</p>
            <h1>Term and Termination</h1>
            <p>This Agreement shall remain in effect until terminated by You or the Company.
            The Company may, in its sole discretion, at any time and for any or no reason, suspend or terminate this Agreement with or without prior notice.</p>
            <p>This Agreement will terminate immediately, without prior notice from the Company, in the event that you fail to comply with any provision of this Agreement. You may also terminate this Agreement by deleting the Application and all copies thereof from your Device or from your computer.</p>
            <p>Upon termination of this Agreement, You shall cease all use of the Application and delete all copies of the Application from your Device.</p>
            <p>Termination of this Agreement will not limit any of the Company's rights or remedies at law or in equity in case of breach by You (during the term of this Agreement) of any of your obligations under the present Agreement.</p>
            <h1>Indemnification</h1>
            <p>You agree to indemnify and hold the Company and its parents, subsidiaries, affiliates, officers, employees, agents, partners and licensors (if any) harmless from any claim or demand, including reasonable attorneys' fees, due to or arising out of your: (a) use of the Application; (b) violation of this Agreement or any law or regulation; or (c) violation of any right of a third party.</p>
            <h1>No Warranties</h1>
            <p>The Application is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Application, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Application will meet your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>
            <p>Without limiting the foregoing, neither the Company nor any of the company's provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Application, or the information, content, and materials or products included thereon; (ii) that the Application will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Application; or (iv) that the Application, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
            <p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law. To the extent any warranty exists under law that cannot be disclaimed, the Company shall be solely responsible for such warranty.</p>
            <h1>Limitation of Liability</h1>
            <p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Agreement and your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You for the Application or through the Application or 100 USD if You haven't purchased anything through the Application.</p>
            <p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Application, third-party software and/or third-party hardware used with the Application, or otherwise in connection with any provision of this Agreement), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
            <p>Some states/jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to You.</p>
            <h1>Severability and Waiver</h1>
            <h2>Severability</h2>
            <p>If any provision of this Agreement is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>
            <h2>Waiver</h2>
            <p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Agreement shall not effect a party's ability to exercise such right or require such performance at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.</p>
            <h1>Product Claims</h1>
            <p>The Company does not make any warranties concerning the Application.</p>
            <h1>United States Legal Compliance</h1>
            <p>You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
            <h1>Changes to this Agreement</h1>
            <p>The Company reserves the right, at its sole discretion, to modify or replace this Agreement at any time. If a revision is material we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at the sole discretion of the Company.</p>
            <p>By continuing to access or use the Application after any revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, You are no longer authorized to use the Application.</p>
            <h1>Governing Law</h1>
            <p>The laws of the Country, excluding its conflicts of law rules, shall govern this Agreement and your use of the Application. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
            <h1>Entire Agreement</h1>
            <p>The Agreement constitutes the entire agreement between You and the Company regarding your use of the Application and supersedes all prior and contemporaneous written or oral agreements between You and the Company.</p>
            <p>You may be subject to additional terms and conditions that apply when You use or purchase other Company's services, which the Company will provide to You at the time of such use or purchase.</p>
            <h1>Contact Us</h1>
            <p>If you have any questions about this Agreement, You can contact Us:</p>
            <ul>
            <li>By email: admin@shoPHP.shop</li>
            </ul>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPEHu0pfTMhTZD1RlVsllbVQufgXrXCt5HFA&usqp=CAU" alt="alternatetext">
          </div>
        </div>
        <!-- Tab content -->
      </div>
    </div>
  </main>
  <?php include_once "include/footer.inc.php" ?>
</body>

</html>