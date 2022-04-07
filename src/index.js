import './scss/style.scss';
import $ from 'jquery';
import CountUp from 'CountUp';
import Swal from 'sweetalert2';

const fields = [
  'donation_amount',
  'payment_method',
  'first_name',
  'last_name',
  'email',
  'phone'
];

const form = $('#form');

const startAnimations = (value) => {
  const currentDonation = $('#total-amount').text().replace(',', '');
  const countUp = new CountUp('total-amount', currentDonation, value, 0, 3);
  const percentage = 100 * (value / donationData.donationTarget);
  if (!countUp.error) {
    countUp.start();
    $('#progress-bar .progress').css('width', `${percentage}%`);
  }
};

const validateForm = (inputData) => {
  const errors = fields.reduce((errorsFound, fieldName) => {
    const isInputValid = inputData.some(
      (data) => data.name === fieldName && (data.value !== '' || data.value)
    );

    if (!isInputValid) {
      const error = {
        name: fieldName,
        text: `${fieldName.replace('_', ' ')} is required`
      };
      return [...errorsFound, error];
    }
    return errorsFound;
  }, []);
  return errors;
};

const clearErrors = () => {
  $('.input-error').each(function () {
    $(this).remove();
  });
};
const displayErrors = (errors) => {
  errors.forEach((error) => {
    $(`<p class="input-error">${error.text}</p>`).insertBefore(
      $(`#form input[name="${error.name}"]`)
    );
  });
};

const onSubmitForm = (e) => {
  $('.submit-button').prop('disabled', true);

  e.preventDefault();
  clearErrors();
  const inputData = form.serializeArray();
  const errors = validateForm(inputData);
  if (errors.length !== 0) {
    $('.submit-button').prop('disabled', false);
    displayErrors(errors);
    return;
  }
  $.post(donationData.ajaxUrl, form.serialize()).then(() => {
    Swal.fire('Success!', 'Donation Submitted', 'success').then(() => {
      const currentDonation = $('#total-amount').text().replace(',', '');
      const updatedTotal =
        Number.parseFloat(currentDonation) +
        Number.parseFloat($('#donation_amount').val());
      startAnimations(updatedTotal);
      $('.submit-button').prop('disabled', false);
      form.trigger('reset');
    });
  });
};

$(() => {
  startAnimations($('#total-amount').text() + donationData.currentDonation);
  $('#donation_amount').on('change', function () {
    const amount = Number.parseFloat($(this).val()).toFixed(2);
    $('#form input[name="donation_amount_copy"]').val(`$ ${amount}`);
    $(this).val(amount);
  });
  $('.submit-button').on('click', () => {
    form.on('submit', onSubmitForm);
  });
});
