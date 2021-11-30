import { useForm } from "@inertiajs/inertia-vue3";

export interface TAttendeNameParts {
    _scheme: string;
    given_name: string;
    family_name: string;
}
export interface TAnswer {
    question: number;
    answer: string | null;
    question_identifier: string | null;
    options: any[];
    option_identifiers: any[];
}
export interface TPosition {
    positionid: number;
    item: number;
    variation: any;
    price: string;
    attendee_name_parts: TAttendeNameParts,
    attendee_email: string | null,
    addon_to: any,
    answers: TAnswer[],
    subevent: number
}
export interface TBooking {
    email: string | null;
    locale: string;
    sales_channel: string;
    fees: Object[];
    payment_provider: string;
    positions: TPosition[]
}

export const form = useForm<TBooking>({
    email: null,
    locale: "de",
    sales_channel: "web",
    fees: [
      {
        fee_type: "payment",
        value: "0.0",
        description: "",
        internal_type: "",
        tax_rule: 29737
      }
    ],
    payment_provider: "free",
    positions: [
      {
        positionid: 1,
        item: 120790,
        variation: null,
        price: "0.00",
        attendee_name_parts: {
      _scheme: "given_family", 
      given_name: "Givenname",
      family_name: "Familyname"
        },
        attendee_email: null,
        addon_to: null,
        answers: [
          {
            question: 28002,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 28003,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 28004,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 28005,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 31085,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 31098,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          },
          {
            question: 31111,
            answer: null,
            question_identifier: null,
            options: [],
            option_identifiers: []
          }
        ],
        subevent: 2701127
      }
    ]
})