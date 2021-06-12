export default [
    {
        type: 'maestro',
        patterns: [
            5018, 502, 503, 506, 56, 58, 639, 6220, 67, 633
        ],
        format: /(\d{1,4})/g,
        length: [12, 13, 14, 15, 16, 17, 18, 19],
        cvcLength: [3],
        luhn: true
    },
    {
        type: 'visa',
        patterns: [4],
        format: /(\d{1,4})/g,
        length: [13, 16],
        cvcLength: [3],
        luhn: true
    },
    {
        type: 'mastercard',
        patterns: [
            51, 52, 53, 54, 55,
            22, 23, 24, 25, 26, 27
        ],
        format: /(\d{1,4})/g,
        length: [16],
        cvcLength: [3],
        luhn: true
    },
    {
        type: 'amex',
        patterns: [34, 37],
        format: /(\d{1,4})(\d{1,6})?(\d{1,5})?/,
        length: [15],
        cvcLength: [3,4],
        luhn: true
    },
    {
        type: 'dinersclub',
        patterns: [30, 36, 38, 39],
        format: /(\d{1,4})(\d{1,6})?(\d{1,4})?/,
        length: [14],
        cvcLength: [3],
        luhn: true
    }
]